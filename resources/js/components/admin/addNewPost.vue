<template lang="pug">
form
    .form-group.label-floating
        label.control-label(for='name') Name
        input#name.form-control(type='text' name='name' required='' data-error='Please enter your name')
        .help-block.with-errors
</template>
<script>
export default {
    data() {
        return {

        }
    }
}
</script>