// $('#sortable').sortable({
//     change:  function (event, ui) {
//         var order = [];
//         //loop trought each li...
//         $('#sortable tr').each( function(e) {
//
//             //add each li position to the array...
//             // the +1 is for make it start from 1 instead of 0
//             order.push( $(this).data('id')  + '=' + ( $(this).index() + 1 ) );
//         });
//         // join the array as single variable...
//         var positions = order.join(';')
//         //use the variable as you need!
//         console.log( positions );
//
//     }
// });
var sortableUpdate = function(self, action){
    var data = [],
        trs = self.children();
    $.each(trs, function(index, elem){
        var id = parseInt($(elem).data('id'));
        if (id>0) data.push(id);
    });

    if (data.length>0) $.ajax({
        type:'post',
        url:action,
        dataType:'json',
        data: {
            _token:window.csrf,
            _method:'put',
            data: data
        },
        error: function(e) {
            console.log(e.responseText);
        }
    });
};
$('.table-sortable').each(function(index,table) {
    var $table = $(table),
        action = $table.data('action');
    if (action) $table.sortable({
        axis:'y',
        helper: function(e, tr)
        {
            var $originals = tr.children();
            var $helper = tr.clone();
            $helper.children().each(function(index)
            {
                // Set helper cell sizes to match the original sizes
                $(this).width($originals.eq(index).outerWidth());
            });
            return $helper;
        },
        update: function(){
            sortableUpdate($(this), action)
        }
    });
});
