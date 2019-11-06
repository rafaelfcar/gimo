$(document).ready(function(){
    $("input[type='button']").button(); 
    
    VerificaSessao();
});
function VerificaSessao(){
    $.post('../../Controller/MenuPrincipal/MenuPrincipalController.php', {
        async: false,
        method: 'VerificaSessao'}, function(result){
        result = eval('('+result+')');
        if (!result){            
            window.location.href='../../index.php';
        }else{
            CarregaMenu();
        }
    });
}
function CarregaMenu(){
    $('#CriaMenu').html('<img src="../../Resources/images/carregando.gif" width="200" height="30">');
    var DadosMenu = '';
    var theme = 'energyblue';
    $.post('../../Controller/MenuPrincipal/MenuPrincipalController.php', {
        async: false,
        method: 'CarregaMenuNew'}, function(menu){
        menu = eval('('+menu+')');
        DadosMenu = menu;
        if (DadosMenu[0]){
            var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'id', map: 'COD_MENU_W' },
                    { name: 'idPai', map: 'COD_MENU_PAI_W' },
                    { name: 'dscMenu', map: 'DSC_MENU_W' },
                    { name: 'subMenuWidth', map: 'VLR_TAMANHO_SUBMENU' }
                ],
                id: 'id',
                localdata: DadosMenu[1]
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            dataAdapter.dataBind();
            var records = dataAdapter.getRecordsHierarchy('id', 'idPai', 'items', [
                {name: 'dscMenu', map: 'label'},
                {name: 'id', map: 'id'}
            ]);
            $('#CriaMenu').jqxMenu({ source: records, height: 30, theme: theme });
            $("#CriaMenu").on('itemclick', function (event) {
                for(i=0;i<DadosMenu[1].length;i++){
                    
                    if (event.args.id==DadosMenu[1][i].COD_MENU_W){                                            
                        if((DadosMenu[1][i].NME_CONTROLLER!='#') && (DadosMenu[1][i].NME_CONTROLLER!='null')){
                            window.location.href=DadosMenu[1][i].NME_PATH+'?method='+DadosMenu[1][i].NME_METHOD;
                        }
                    }
                }
            });
        }
    });
}