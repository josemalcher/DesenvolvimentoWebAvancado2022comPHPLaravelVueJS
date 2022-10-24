<template>
    <div :class="estilo" role="alert">
        {{titulo}}
        <hr>
        <span v-if="detalhes.data.message">
            {{detalhes.data.message}}
        </span>
        <span v-if="detalhes.data.id">
            ID do Registro {{detalhes.data.id}}
        </span>
        <br>
        <ul v-if="detalhes.data.errors">
            <li v-for="e, key in detalhes.data.errors" :key="key">
                {{ e[0] }}
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: "Alert.vue",
    props: ['tipo', 'titulo', 'detalhes'],
    computed: {
        estilo() {
            return 'alert alert-' + this.tipo
        },
    }
}
</script>

<style scoped>

</style>
