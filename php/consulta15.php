<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();

    /////////////////////////
    date_default_timezone_set('America/Bogota');

    /*
    N Días se la semana del 1 al 7
    l nombre del dia de la semana
    */

    
    

    $mes  = $_POST['mes'];
    $year = $_POST['anio'];
    $user = $_POST['user'];
    $existe = false;

    //  obtener id de fecha

    $consulta = mysqli_query($conexion, "SELECT * FROM `fechas`  
    WHERE `mes`= '$mes' AND `year`= '$year'") or die ("Error al consultar: proveedores");
    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        $existe[1] = true;
        $id_fecha = $fila['id_fecha'];
    }
    mysqli_free_result($consulta);


    $dias_semana = array("Lunes","Martes","Miércoles","Jueves","Viernes","Sábado","Domingo");
    $days_week = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
    $nmeses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
    $dias_meses = array(31,28,31,30,31,30,31,31,30,31,30,31);

    //Si existen registros para esa fecha
    if($existe == true){

        $id_ven_dia = array();
        $ventas = array();


        $consulta = mysqli_query($conexion, "SELECT `id_ven_dia`, `ventas` 
        FROM `ventas_diarias` 
        WHERE `id_fecha1`='$id_fecha'
        ORDER BY `id_ven_dia` ASC") or die ("Error al consultar: proveedores");

        while (($fila = mysqli_fetch_array($consulta))!=NULL){
            array_push($id_ven_dia, $fila['id_ven_dia']);
            array_push($ventas, $fila['ventas']);
        }
        mysqli_free_result($consulta);
           
        //Miramos si este año es bisiesto
        if(date('L', time()) == 1){
            //Actualizamos febrero
            $dias_meses[1] += 1;
        }
    
        $días_anteriores = array_search(date("l", mktime(0, 0, 0, $mes, 1, $year)), $days_week);
        $contador_dias_ant = 0;
        ?>
        <div style="background-color:#dddddd">
            <div style="width=75%;backgorund-color:white">
                <?php
                $mes ;
                //echo $nmeses[$mes-1]."<br>"; // MES
    
                ?>
                <form id="calendario" method="POST">
                <table style="width:100%;border: 1px solid black; border-collapse: collapse;overflow:auto;margin-left: auto;  margin-right: auto;" border="1">
                
                    <tr>
    
                <?php
    
                for ($i=0; $i < 7; $i++) { 
    
                    echo "<th style='width:14%'>".$dias_semana[$i]."</th>";
    
    
                }
                ?>
                    </tr>
                    <tr>
                <?php
    
                //Imprimimos los recuadros solo de los dias anteriores
                for ($i=0; $i < $días_anteriores; $i++) { 
                    $contador_dias_ant++;
                    
                    echo "<td style='background-color: #dddddd'></td>";
                }
                
    
                
                for ($i=1; $i <= $dias_meses[$mes-1]; $i++) { 
                    // el $mes es el actual ya que no estamos accediendo a ninguna posicion de algun array
                    // Numero Día $i
                    // Nombre Día date("l", mktime(0, 0, 0, $mes, $i, $year))
                    $contador_dias_ant++;
                    ?>
                    <input type="hidden" name="mes" id="mes" value="<?php echo $id_fecha ?>"/>
                    <input type="hidden" name="anio" id="anio" value="<?php echo $id_fecha ?>"/>
                    <input type="hidden" name="nanio" id="nanio" value="<?php echo $year ?>"/>
                    <input type="hidden" name="id_ven_dia[]" value="<?php echo $id_ven_dia[$i-1] ?>"/>
                    <td class='tdcalendario' style='width:14%'>
                        <span class='ncalendario'><?php echo $i; ?></span><br>
                        <input type='text' name='ventas_dias[]' class='puntos' value="<?php echo number_format($ventas[$i-1], 0, ',', '.') ?>" size='15' style='background: transparent;border: none;border-bottom: 2px solid gray;'/>
                    </td>
                    <?php
                    if($contador_dias_ant==7){
                        echo "</tr><tr>";
                        $contador_dias_ant=0;
                    }
                }
                ?>
                </tr>
                <tr>
                    <td onclick="grafico_mensual()"><span class="w3-btn" style="background-color: #478248;color:white;">Gráfica del Mes</span></td>
                    <td onclick="grafico_anual()"><span class="w3-btn" style="background-color: #478248;color:white;">Gráfica Anual</span></td>
                    <td colspan="4"></td>
                    <td><img src="../iconos/guardar.png" width="60px" height="60px" class="btn_guardar" id="enviar15_2" class="w3-btn" class="btn_icono"></td>
 

                </tr>
                </table>
                </form>
            </div>
        </div>
        <?php
    }else{
        //Creamos un regsitro de presupuesto, ya que es de donde obtenemos la fecha
        $consulta = mysqli_query($conexion, "INSERT INTO `fechas`(`mes`, `year`) 
        VALUES ('$mes','$year')") or die ("Error al update: presupuesto");

        $consulta = mysqli_query($conexion, "SELECT * FROM `fechas`  
        WHERE `mes`= '$mes' AND `year`= '$year'") or die ("Error al consultar: proveedores");

        while (($fila = mysqli_fetch_array($consulta))!=NULL){
            $id_fecha = $fila['id_fecha'];
        }
        mysqli_free_result($consulta);


        //Ahora creamos los registros del mes y año de ventas diarias
        for ($i = 0; $i < $dias_meses[$mes-1]; $i++) { 

            $consulta = mysqli_query($conexion, "INSERT INTO `ventas_diarias`(`id_fecha1`, `ventas`) 
            VALUES ('$id_fecha', NULL)") or die ("Error al update: presupuesto");
            
        }


        echo "<script>$('#enviar15_1').trigger('click');</script>";
    }
    

    ?>  
        <div class="ventana" id="div_canvas2" style="background:rgba(0, 0, 0, 0.8);"></div>
    <?php
    
?>

<script>
    $('#enviar15_2').click(function(){
        $.ajax({
            url:'../php/consulta15_1.php',
            type:'POST',
            data: $('#calendario').serialize(),
            success: function(res){
                
                /*Swal.fire(
                '¡Muy bien!',
                'Guardado Exitoso',
                'success'
                )*/
                $('#enviar15_1').trigger('click');
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    });

    function grafico_mensual() {

        $.ajax({
            url:'../php/graficaCalendario1.php',
            type:'POST',
            data: $('#calendario').serialize(),
            success: function(res){
                $('#div_canvas2').html(res);
                document.getElementById('div_canvas2').style.display='block';
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    }
    function grafico_anual() {

        $.ajax({
            url:'../php/graficaCalendario2.php',
            type:'POST',
            data: $('#calendario').serialize(),
            success: function(res){
                $('#div_canvas2').html(res);
                document.getElementById('div_canvas2').style.display='block';
            },
            error: function(res){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    }
</script>