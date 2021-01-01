<template>
    <editor :value="value" @input="update"
            :api-key="apiKey"
            :init="init"
    ></editor>
</template>

<script>
import editor from '@tinymce/tinymce-vue';

export default {
    mixins: [Fieldtype],
    components: {
        editor: editor
    },
    computed: {
        apiKey() {
            return this.meta.key;
        },
        init() {
            return this.meta.init;
        }
    }
};
</script>
