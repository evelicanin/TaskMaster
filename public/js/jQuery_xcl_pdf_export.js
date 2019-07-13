$(document).ready(fun).on('page:load', fun);

function fun() {

    exportToXLS();
    exportToPDF();
}


////////////////////////////////////////////////////////////////////////
/////////////////////////-------Save to xls-------//////////////////////
////////////////////////////////////////////////////////////////////////

function exportToXLS() {
    $(".xls_save").click(function(e) {
        var uri = 'data:application/vnd.ms-excel;base64,'
            , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>'
            , base64 = function(s) {
                return window.btoa(unescape(encodeURIComponent(s)));
            }
            , format = function(s, c) {
                return s.replace(/{(\w+)}/g, function(m, p) {
                    return c[p];
                })
            }
        var table = $(this).closest('div').find("table").clone();
        table.find("tbody tr").each(function() {
            $(this).show();
        });
        table = table.html();
        window.location.href = uri + base64(format(template, {worksheet: 'Worksheet', table: table}));
        e.preventDefault();
    });
}

//////////////////////////////////////////////////////////////////////////
///////////////////////////-------Save to xls-------//////////////////////
//////////////////////////////////////////////////////////////////////////

function exportToPDF() {
    $(".pdf_save").click(function() {
        var pdf = new jsPDF('p', 'pt', 'letter');
        var source = "<table>" + $(this).closest('div').find('table').html() + "</table>";
        specialElementHandlers = {
            '#bypassme': function(element, renderer) {
                return true
            }
        };
        margins = {
            top: 80,
            bottom: 60,
            left: 40,
            width: 522
        };
        pdf.fromHTML(
            source,
            margins.left,
            margins.top, {
                'width': margins.width,
                'elementHandlers': specialElementHandlers
            },
            function(dispose) {
                pdf.save('Test.pdf');
            }, margins);
    });
}