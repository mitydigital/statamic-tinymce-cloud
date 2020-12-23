import TinymceCloudFieldtype from './components/tinymce-cloud';

Statamic.booting(() => {
    Statamic.$components.register('tinymce_cloud-fieldtype', TinymceCloudFieldtype);
});
