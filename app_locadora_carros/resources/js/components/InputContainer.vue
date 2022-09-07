<template>
    <div class="form-group">
        <label :for="id" class="form-label">{{ titulo }}</label>
            <slot></slot>
        <div :id="idHelp" class="form-text text-muted">{{ textoAjuda }}</div>
    </div>
</template>

<script>
export default {
    name: "InputContainer",
    props: ['id', 'titulo', 'idHelp', 'textoAjuda']
}
</script>

<style scoped>

</style>
