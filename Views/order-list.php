<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <?php
                    if(isset($message)){                    
               ?>
                    <script> 
                         alert("<?php echo $message; ?>");
                    </script>
               <?php
                    }
               ?>

               <h2 class="mb-4">Listado de todas las Ordenes</h2>
               <table class="table bg-light-alpha">
                    <thead>                         
                         <th>Código</th>
                         <th>Estado</th>
                         <th>Descripcion</th>
                         <th>Tecnico</th>
                         <th>Cliente</th>
                         <th>Telefono</th>
                         <th>Opcion</th>
                    </thead>
                    <tbody>
                         <?php 
                         foreach($ordersList as $order){                       
                         ?>
                              <tr>
                                   <td> <?php echo $order->getOrderId();?></td>
                                   <td>
                                        <form action="<?php echo FRONT_ROOT?>Order/EditStatus" method="post">
                                             <input name="orderId" value="<?php echo $order->getOrderId();?>" hidden>
                                             <select name="orderStatusId" class="form-control">
                                                  <optgroup>
                                                       <option disabled selected><?php echo "Actual: ". $order->getOrderStatusId();?></option>                                        
                                                       <?php
                                                            foreach($orderStatusList as $orderStatus){
                                                       ?>
                                                                 <option value="<?php echo $orderStatus->getOrderStatusId();?>"> <?php echo "Cambiar a: ".$orderStatus->getDescription();?> </option>
                                                       <?php        
                                                            }
                                                       ?>
                                                  </optgroup>
                                             </select>
                                             <button type="submit" class="btn btn-danger ml-auto d-block"> Actualizar estado</button>
                                        </form>
                                   </td>
                                   <td> <?php echo $order->getDescription();?></td>
                                   <td> <?php echo $order->getTechnicalId();?></td>
                                   <td> 
                                        <?php 
                                             // esto era antes de unir nombre con telefono
                                             // echo $order->getClientId();
                                             // con el / corto el string en 2 partes para el nombre uso la parte 1
                                             $telefono = explode('/',  $order->getClientId());
                                             //var_dump($telefono);
                                             echo $telefono[0];
                                        ?>
                                   </td>
                                   <td> 
                                        <?php 
                                             // con el / corto el string en 2 partes para el telefono uso la parte 2
                                             $telefono = explode('/',  $order->getClientId());
                                             //var_dump($telefono);
                                             echo $telefono[1];
                                        ?>
                                   </td>
                                   <td> 
                                        <form class="bg-light-alpha" action="<?php echo FRONT_ROOT ?>Order/Delete">
                                             <div class="row">
                                                  <div class="col-lg-2">
                                                       <div class="form-group">
                                                            <input name="orderId" value="<?php echo $order->getOrderId();?>" hidden>
                                                            <button type="submit" class="btn btn-dark ml-auto d-block">Eliminar</button>
                                                       </div>
                                                  </div>                         
                                             </div>
                                        </form>
                                   </td>
                              </tr>
                         <?php
                         }
                         ?>
                    </tbody>
               </table>
          </div>
     </section>
</main>