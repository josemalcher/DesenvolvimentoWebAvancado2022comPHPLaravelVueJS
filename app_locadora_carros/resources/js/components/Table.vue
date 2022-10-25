<template>
    <div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col" v-for="t, key in titulos" :key="key">{{ t }}</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="m in dados" :key="m.id">
                <th scope="row">{{ m.id }}</th>
                <td>{{ m.nome }}</td>
                <td><img :src="'/storage/'+m.imagem" width="30px" height="30px"></td>
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
