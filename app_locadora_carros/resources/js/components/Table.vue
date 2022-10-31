<template>
    <div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col" v-for="t, key in titulos" :key="key">{{ t.titulo }}</th>
                <th v-if="visualizar.visivel || atualizar || remover.visivel"></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="obj, chave in dadosFiltrados" :key="chave">
                <td v-for="valor, chaveValor in obj" :key="chaveValor">
                    <span v-if="titulos[chaveValor].tipo == 'texto'">{{ valor }}</span>
                    <span v-if="titulos[chaveValor].tipo == 'data'">
                            {{ '...' + valor }}
                        </span>
                    <span v-if="titulos[chaveValor].tipo == 'imagem'">
                            <img :src="'/storage/'+valor" width="30" height="30">
                        </span>
                </td>
                <td v-if="visualizar.visivel || atualizar || remover.visivel">
                    <button v-if="visualizar.visivel" class="btn btn-outline-primary btn-sm"
                            :data-toggle="visualizar.dataToggle"
                            :data-target="visualizar.dataTarget"
                            @click="setStore(obj)"
                    >
                        Visualizar
                    </button>
                    <button v-if="atualizar" class="btn btn-outline-primary btn-sm">Atualizar</button>
                    <button v-if="remover.visivel" class="btn btn-outline-danger btn-sm"
                            :data-toggle="remover.dataToggle"
                            :data-target="remover.dataTarget"
                            @click="setStore(obj)"
                    >
                        Remover
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    name: "Table",
    props: ['dados', 'titulos', 'atualizar', 'visualizar', 'remover'],
    methods: {
        setStore(obj) {
            this.$store.state.transacao.status = ''
            this.$store.state.transacao.mensagem = ''
            this.$store.state.item = obj
        }
    },
    computed: {
        dadosFiltrados() {
            let campos = Object.keys(this.titulos)
            let dadosFiltrados = []
            // console.log(campos)

            this.dados.map((item, chave) => {
                // console.log(chave, item)

                let itemFiltrado = {}
                campos.forEach(campo => {
                    // console.log(campo)
                    itemFiltrado[campo] = item[campo]
                    // console.log(chave, item, campo)
                })
                dadosFiltrados.push(itemFiltrado)
            })
            console.log(dadosFiltrados)
            return dadosFiltrados
        }
    }
}
</script>

<style scoped>

</style>
