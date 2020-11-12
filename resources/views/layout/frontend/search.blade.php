@php
use App\Models\Mproduct;
$listSearch = Mproduct::where('status', 1)
->where('trash', 1)
->select('name', 'sku')
->get();
@endphp
<script>
    var countries = [
        @foreach($listSearch as $item)
        {
            value: '{{ $item['name'] }}',
            data: '{{ $item['sku'] }}'
        },
        @endforeach
    ];

    $('#autocomplete').devbridgeAutocomplete({
        lookup: countries,
        onSelect: function(suggestion) {
            $(".autocomplete").val(suggestion.value);
        },
        transformResult: function(response) {
            return {
                suggestions: $.map($.parseJSON(response), function(item) {
                    return {
                        value: item.name,
                        data: item.sku
                    };
                }),
            };
        },
    });

</script>
