<template>
    <div :class="estilo" role="alert">
        {{titulo}}
        <hr>
        <p>{{ detalhes.mensagem }}</p>
        <br>
        <ul v-if="detalhes.dados">
            <li v-for="e, key in detalhes.dados" :key="key">
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
