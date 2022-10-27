<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">


                <!-- início do card de busca -->
                <card-component titulo="Busca de marcas">
                    <template v-slot:conteudo>
                        <div class="form-row">
                            <div class="col mb-3">
                                <input-container-component titulo="ID" id="inputId" id-help="idHelp"
                                                           texto-ajuda="Opcional. Informe o ID da marca">
                                    <input type="number" class="form-control" id="inputId" aria-describedby="idHelp"
                                           placeholder="ID"
                                           v-model="busca.id"
                                    >
                                </input-container-component>
                            </div>
                            <div class="col mb-3">
                                <input-container-component titulo="Nome da marca" id="inputNome" id-help="nomeHelp"
                                                           texto-ajuda="Opcional. Informe o nome da marca">
                                    <input type="text" class="form-control" id="inputNome" aria-describedby="nomeHelp"
                                           placeholder="Nome da marca"
                                           v-model="busca.nome"
                                    >
                                </input-container-component>
                            </div>
                        </div>
                    </template>

                    <template v-slot:rodape>
                        <button type="submit" class="btn btn-primary btn-sm float-right"
                                @click="pesquisar()"
                        >
                            Pesquisar
                        </button>
                    </template>
                </card-component>
                <!-- fim do card de busca -->


                <!-- início do card de listagem de marcas -->
                <card-component titulo="Relação de marcas">
                    <template v-slot:conteudo>
                        <table-component
                            :dados="marcas.data"
                            :visualizar="{
                                visivel: true,
                                dataToggle: 'modal',
                                dataTarget: '#modalMarcaViasualizar'
                            }"
                            :atualizar="true"
                            :remover="true"
                            :titulos="{
                                id:         {titulo: 'ID', tipo: 'texto'},
                                nome:       {titulo: 'Nome', tipo: 'texto'},
                                imagem:     {titulo: 'Imagem', tipo: 'imagem'},
                                created_at: {titulo: 'Data de Criação', tipo: 'data'}
                            }"
                        ></table-component>
                    </template>

                    <template v-slot:rodape>
                        <div class="row">
                            <div class="col-10">
                                <paginate-component>
                                    <li v-for="l, key in marcas.links"
                                        :key="key"
                                        :class="l.active ? 'page-item active' : 'page-item'"
                                        @click="paginacao(l)"
                                    >
                                        <a class="page-link" v-html="l.label"></a>
                                    </li>
                                </paginate-component>
                            </div>

                            <div class="col">
                                <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal"
                                        data-target="#modalMarca">Adicionar
                                </button>
                            </div>
                        </div>
                    </template>
                </card-component>
                <!-- fim do card de listagem de marcas -->
            </div>
        </div>
        <!--   Inicio do modal de inclusão de marca     -->
        <modal-component id="modalMarca" titulo="Adicionar marca">

            <template v-slot:alertas>
                <alert-component tipo="success"
                                 :detalhes="transacaoDetalhes"
                                 titulo="Cadastro Realizado com Sucesso"
                                 v-if="transacaoStatus == 'adicionado'"></alert-component>
                <alert-component tipo="danger"
                                 :detalhes="transacaoDetalhes"
                                 titulo="Erro ao Casdastrar a marca"
                                 v-if="transacaoStatus == 'erro'"></alert-component>
            </template>

            <template v-slot:conteudo>
                <div class="form-group">
                    <input-container-component titulo="Nome da marca" id="novoNome" id-help="novoNomeHelp"
                                               texto-ajuda="Informe o nome da marca">
                        <input
                            v-model="nomeMarca"
                            type="text" class="form-control" id="novoNome" aria-describedby="novoNomeHelp"
                            placeholder="Nome da marca">
                    </input-container-component>
                    {{ nomeMarca }}
                </div>

                <div class="form-group">
                    <input-container-component titulo="Imagem" id="novoImagem" id-help="novoImagemHelp"
                                               texto-ajuda="Selecione uma imagem no formato PNG">
                        <input
                            @change="carregarImagem($event)"
                            type="file" class="form-control-file" id="novoImagem" aria-describedby="novoImagemHelp"
                            placeholder="Selecione uma imagem">
                    </input-container-component>
                    {{ arquivoImagem }}
                </div>
            </template>

            <template v-slot:rodape>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button
                    @click="salvar()"
                    type="button" class="btn btn-primary">Salvar
                </button>
            </template>
        </modal-component>
        <!--   FINAL do modal de inclusão de marca     -->

        <!--   INICIO do modal de visualização de marca     -->
        <modal-component id="modalMarcaViasualizar" titulo="Visualiar Marca">
            <template v-slot:alertas></template>
            <template v-slot:conteudo>
                <input-container-component titulo="ID">
                    <input type="text" class="form-control" :value="$store.state.item.id" disabled>
                </input-container-component>

                <input-container-component titulo="Nome da marca">
                    <input type="text" class="form-control" :value="$store.state.item.nome" disabled>
                </input-container-component>

                <input-container-component titulo="Imagem">
                    <img :src="'storage/'+$store.state.item.imagem" v-if="$store.state.item.imagem">
                </input-container-component>

                <input-container-component titulo="Data de criação">
                    <input type="text" class="form-control" :value="$store.state.item.created_at" disabled>
                </input-container-component>
            </template>
            <template v-slot:rodape>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </template>
        </modal-component>
        <!--   FINAL do modal de visualização de marca     -->
    </div>
</template>

<script>
export default {
    computed: {
        token() {

            let token = document.cookie.split(';').find(indice => {
                return indice.includes('token=')
            })

            token = token.split('=')[1]
            token = 'Bearer ' + token

            return token
        }
    },
    data() {
        return {
            urlBase: 'http://127.0.0.1:8000/api/v1/marca',
            urlPaginacao: '',
            urlFiltro: '',
            nomeMarca: '',
            arquivoImagem: [],
            transacaoStatus: '',
            transacaoDetalhes: {},
            marcas: {data: []},
            busca: {id: '', nome: ''}
        };
    },
    methods: {
        pesquisar() {
            let filtro = ''
            for (let chave in this.busca) {

                if (this.busca[chave]) {
                    if (filtro != '') {
                        filtro += ';'
                    }
                    filtro += chave + ':like:' + this.busca[chave]
                }
            }
            if (filtro != '') {
                this.urlPaginacao = 'page=1'
                this.urlFiltro = '&filtro=' + filtro
            } else {
                this.urlFiltro = ''
            }
            this.carregarLista()

        },
        paginacao(l) {
            if (l.url) {
                // this.urlBase = l.url // ajustando a url de consulta com o parâmetro da página
                this.urlPaginacao = l.url.split('?')[1]
                this.carregarLista() // requisitando novamente os dados para nossa API
            }
        },
        carregarLista() {

            let url = this.urlBase + '?' + this.urlPaginacao + this.urlFiltro

            let config = {
                headers: {
                    'Accept': 'application/json',
                    'Authorization': this.token
                }
            }

            axios.get(url, config)
                .then(response => {
                    this.marcas = response.data
                    // console.log(this.marcas.data)
                })
                .catch(errors => {
                    console.log(errors)
                })
        },

        carregarImagem(e) {
            this.arquivoImagem = e.target.files
        },
        salvar() {
            console.log(this.nomeMarca, this.arquivoImagem)

            let formData = new FormData()

            formData.append('nome', this.nomeMarca);
            formData.append('imagem', this.arquivoImagem[0]);

            let config = {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'Accept': 'application/json',
                    'Authorization': this.token
                }
            }

            axios.post(this.urlBase, formData, config)
                .then(response => {
                    this.transacaoStatus = 'adicionado'
                    this.transacaoDetalhes = {
                        mensagem: 'ID do Registro: ' + response.data.id
                    }

                })
                .catch(errors => {
                    this.transacaoStatus = 'erro'
                    // this.transacaoDetalhes = errors.response // errors.response.data.message
                    this.transacaoDetalhes = {
                        mensagem: errors.response.data.message,
                        dados: errors.response.data.errors
                    }
                })
        }
    },
    mounted() {
        this.carregarLista()
    }
}
</script>
