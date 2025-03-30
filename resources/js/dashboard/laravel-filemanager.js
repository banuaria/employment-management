function filemanagerPicker(event) {
    let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
    let y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

    const base_url = window.location.origin;
    let lfmUrl = base_url + '/cms/laravel-filemanager?type='+event.filetype;

    const windowWidth = x * 0.8;
    const windowHeight = y * 0.8;

    const left = (window.innerWidth - windowWidth) / 2;
    const top = (window.innerHeight - windowHeight) / 2 + (window.screen.height - window.innerHeight) / 2;

    const options = `width=${windowWidth}, height=${windowHeight}, left=${left}, top=${top}, resizable=yes`;

    window.open(lfmUrl, 'FileManager', options);

    window.SetUrl = function (items) {
        var paths = items.map(function (item) {
            const url = new URL(item.url);
            const pathname = url.pathname;
            return pathname;
        });

        Livewire.dispatchTo(event.to, 'listen-filemanager-picker', { 'property': event.property, 'path': paths[0] });
    };
}

export { filemanagerPicker };