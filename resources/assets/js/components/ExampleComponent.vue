<template>
    <select></select>
</template>

<script>
require('./../../bower/select2/dist/js/select2.min.js');
    export default {
        mounted() {
            $('select').select2();
        }
    }
</script>