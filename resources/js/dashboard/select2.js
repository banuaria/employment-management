import $ from 'jquery';
import select2 from 'select2';
select2($);

import 'select2/dist/css/select2.min.css';

function select2select() {
    $('.select2-select').each(function() {
        var $this = $(this);

        if ($this.data('select2')) {
            $this.select2('destroy');
            $this.off('change');
        }

        const selectId = $this.attr('select2-select-id');

        $this.select2({
            width: '100%'
        }).on('change', function () {
            Livewire.dispatch('select2-select', { 'values': $this.val(), 'selectId': selectId });
        });
    });
}

export { select2select };