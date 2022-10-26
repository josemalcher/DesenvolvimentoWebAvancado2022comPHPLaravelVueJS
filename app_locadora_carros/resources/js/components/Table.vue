<template>
    <div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col" v-for="t, key in titulos" :key="key" class="text-uppercase">{{ t }}</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="obj in dados" :key="obj.id">
                <!--<th scope="row">{{ m.id }}</th>
                    <td>{{ m.nome }}</td>
                    <td><img :src="'/storage/'+m.imagem" width="30px" height="30px"></td>-->
                <td
                    v-if="titulos.includes(chave)"
                    v-for="valor, chave in obj" :key="chave"
                >
                    <span v-if="chave == 'imagem'">
                        <img :src="'/storage/'+valor" width="30px" height="30px">
                    </span>
                    <span v-else>
                        {{ valor }}
                    </span>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    name: "Table",
    props: ['dados', 'titulos']
}
</script>

<style scoped>

</style>
