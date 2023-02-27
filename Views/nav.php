<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
     <span class="navbar-text">
          <strong> <?php echo COMERCE_NAME; ?></strong>
          <?php
               if(isset($_SESSION['technical']))
          ?>
                    <h2 class="mb-4"> <?php echo "Hola ".$_SESSION['technical']->getUserName(); ?> </h2>
        
     </span>
     <ul class="navbar-nav ml-auto">
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Client/ShowAddView">Registrar cliente</a>
          </li> 
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Client/ShowListView">Listar clientes</a>
          </li> 
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Repair/ShowAddView">Agregar Ordenes</a>
          </li>  
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Repair/ShowListOrderView">Listar mis ordenes</a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Repair/ShowListAllOrderView">Listar todas las ordenes</a>
          </li> 
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Technical/Logout">Cerrar Sesión</a>
          </li>        
     </ul>
</nav>