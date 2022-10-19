<template>
    <div :class="estilo" role="alert">A Mensagem</div>
</template>

<script>
export default {
    name: "Alert.vue",
    props: ['tipo'],
    computed: {
        estilo() {
            return 'alert alert-' + this.tipo
        },
    }
}
</script>

<style scoped>

</style>
