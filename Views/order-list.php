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
                         <th>Opcion</th>
                    </thead>
                    <tbody>
                         <?php 
                         foreach($ordersList as $order){                       
                         ?>
                              <tr>                             
                                   <td> <?php echo $order->getOrderId();?></td>
                                   <td> <?php echo $order->getOrderStatusId();?></td>
                                   <td> <?php echo $order->getDescription();?></td>
                                   <td> <?php echo $order->getTechnicalId();?></td>
                                   <td> <?php echo $order->getClientId();?></td>
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