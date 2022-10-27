<template>
    <div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col" v-for="t, key in titulos" :key="key">{{t.titulo}}</th>
                <th v-if="visualizar || atualizar || remover"></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="obj, chave in dadosFiltrados" :key="chave">
                <td v-for="valor, chaveValor in obj" :key="chaveValor">
                    <span v-if="titulos[chaveValor].tipo == 'texto'">{{valor}}</span>
                    <span v-if="titulos[chaveValor].tipo == 'data'">
                            {{ '...'+valor}}
                        </span>
                    <span v-if="titulos[chaveValor].tipo == 'imagem'">
                            <img :src="'/storage/'+valor" width="30" height="30">
                        </span>
                </td>
                <td v-if="visualizar || atualizar || remover">
                    <button v-if="visualizar" class="btn btn-outline-primary btn-sm">Visualizar</button>
                    <button v-if="atualizar" class="btn btn-outline-primary btn-sm">Atualizar</button>
                    <button v-if="remover" class="btn btn-outline-danger btn-sm">Remover</button>
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
