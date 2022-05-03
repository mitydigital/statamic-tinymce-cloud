import TinymceCloudFieldtype from './components/tinymce-cloud.vue';

Statamic.booting(() => {
    Statamic.$components.register('tinymce_cloud-fieldtype', TinymceCloudFieldtype);
});
