<?php
require_once('services/request_type/request_type.php');

function display_request_form($request = '', $details = '') {
	$edit = is_array($request);
    ?>
	<script src="<?php echo HOSTNAME;?>js/cleave.min.js"></script>
	<form method="POST" action="<?php echo $edit ? HOSTNAME.'request/update' : HOSTNAME.'request/insert'; ?>">
	<?php
	if ($edit) {
		echo '<input type="hidden" name="id" value="'. htmlspecialchars($request['id']).'" />';
	}
	?>
	  <div class="form-row">
		<div class="form-group col-md-6">
		  <label for="title">Título</label>
		  <input type="text" class="form-control" id="title" name="title" placeholder="Título"
		  <?php if($details) echo 'readonly';?> value="<?php echo htmlspecialchars($edit ? $request['title'] : ''); ?>"  required>
		</div>
		<div class="form-group col-md-6">
			<label for="request_type_id">Tipo de Solicitação</label>
			<select id="request_type_id" name="request_type_id" class="form-control" <?php if($details) echo 'disabled';?> required>
			  <option value="">Selecione...</option>
			  <?php
			  $activity_array=get_request_types();
			  foreach ($activity_array as $thiscat) {
				   echo "<option value=\"".htmlspecialchars($thiscat['id'])."\"";
				   
				   if (($edit) && ($thiscat['id'] == $request['request_type_id'])) {
					   echo " selected";
				   }
				   echo ">".htmlspecialchars($thiscat['name'])."</option>";
			  }
			  ?>
			</select>
		  </div>
	  </div>
	  <div class="form-row">
		<div class="form-group col-md-12">
		  <label for="description">Descrição</label>
		  <textarea <?php if($details) echo 'disabled';?> class="form-control" id="description" name="description" rows="3" placeholder="Descrição"><?php echo htmlspecialchars(isset($_POST['description']) ? $_POST['description'] : ($edit ? $request['description'] : '')); ?></textarea>
		</div>
	  </div>
	  <h5>Dados de contato do Cliente:</h5>
	  <hr />
	  <div class="form-row">
	    <div class="form-group col-md-6">
		  <label for="client_name">Nome</label>
		  <input type="text" class="form-control" id="client_name" name="client_name" placeholder="Nome"
		  <?php if($details) echo 'disabled';?> value="<?php echo htmlspecialchars(isset($_POST['client_name']) ? $_POST['client_name'] : ($edit ? $request['client_name'] : '')); ?>" required>
		</div>
		<div class="form-group col-md-6">
		  <label for="email">Email</label>
		  <input type="email" class="form-control" id="email" name="email" placeholder="Email"
		  <?php if($details) echo 'disabled';?> value="<?php echo htmlspecialchars(isset($_POST['email']) ? $_POST['email'] : ($edit ? $request['email'] : '')); ?>" required>
		</div>
		<div class="form-group col-md-6">
		  <label for="phone">Telefone</label>
		  <input type="text" class="form-control" id="phone" name="phone" placeholder="Telefone"
		  <?php if($details) echo 'disabled';?> value="<?php echo htmlspecialchars(isset($_POST['phone']) ? $_POST['phone'] : ($edit ? $request['phone'] : '')); ?>">
		</div>
		<script type="text/javascript">
			new Cleave('#phone', {
				blocks: [2, 4, 4],
				delimiters: ['-', '-'],
				numericOnly: true
			});
        </script>
		<div class="form-group col-md-6">
			<label for="request_status_id">Status Solicitação</label>
			<select id="request_status_id" name="request_status_id" class="form-control" <?php if($details) echo 'disabled';?> required>
			  <option value="">Selecione...</option>
			  <?php
			  $activity_array=get_request_status();
			  foreach ($activity_array as $thiscat) {
				   echo "<option value=\"".htmlspecialchars($thiscat['id'])."\"";
				   
				   if (($edit) && ($thiscat['id'] == $request['request_status_id'])) {
					   echo " selected";
				   }
				   echo ">".htmlspecialchars($thiscat['name'])."</option>";
			  }
			  ?>
			</select>
		  </div>
	  </div>
	  <?php
	  if($details){
		  ?><input type="button" class="btn btn-primary" onclick="location.href='<?php echo HOSTNAME;?>request/edit/<?php echo $request['id'];?>';" value="Alterar Solicitação" /><?php
	  } else {
		  ?><button type="submit" class="btn btn-warning"><?php echo $edit ? 'Alterar' : 'Adicionar'; ?> Solicitação</button><?php
	  }
	  if ($edit){
		  ?>
		  <input class="btn btn-danger" type="button" id="delete" value='Remover Solicitação' />
		  <script type="text/javascript">
		  document.getElementById('delete').onclick = function () {
		      if (confirm('Deseja realmente Remover este Registro?')) {
		          parent.location="<?php echo HOSTNAME.'request/delete/'.$request['id']; ?>";
		      }
		  };
		  </script>
		  <?php
	  }	  
	  ?>
	</form>
	<hr />
<?php
}

function display_requests($cat_array) {
	if (!is_array($cat_array)) {
		do_html_mensagem('Nenhuma Solicitação foi encontrado na base de dados.', 'warning');
        return;
    }
    ?>
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Lista de Solicitações</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Título</th>
												<th>Tipo de Solicitação</th>
												<th>Descrição</th>
												<th>Data Solicitação</th>
												<th>Nome Cliente</th>
												<th>Email</th>
												<th>Telefone</th>
												<th>Status Solicitação</th>
                                                <th>Menu</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Título</th>
												<th>Tipo de Solicitação</th>
												<th>Descrição</th>
												<th>Data Solicitação</th>
												<th>Nome Cliente</th>
												<th>Email</th>
												<th>Telefone</th>
												<th>Status Solicitação</th>
                                                <th>Menu</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        <?php
										$i = 0;
                                        foreach ($cat_array as $row) {
											$i = $i + 1;
		                                    ?>
                                            <tr>
                                                <td><?php echo $row['id'];?></td>
                                                <td><?php echo $row['title'];?></td>
												<td><?php echo $row['request_type'];?></td>
												<td><?php echo $row['description'];?></td>
												<td><?php echo $row['request_data'];?></td>
												<td><?php echo $row['client_name'];?></td>
												<td><?php echo $row['email'];?></td>
												<td><?php echo $row['phone'];?></td>
												<td><?php echo $row['request_status'];?></td>
                                                <td>
												<form id="form<?php echo $i;?>" method="post">
												    <input type="button" class="btn btn-success btn-sm" onclick="location.href='<?php echo HOSTNAME;?>request/details/<?php echo $row['id'];?>';" value="Detalhes" />
												    <input type="button" class="btn btn-warning btn-sm" onclick="location.href='<?php echo HOSTNAME;?>request/edit/<?php echo $row['id'];?>';" value="Alterar" />
													<input class="btn btn-danger btn-sm" type="button" id="delete<?php echo $i;?>" value='Remover' />
													<script type="text/javascript">
													document.getElementById('delete<?php echo $i;?>').onclick = function () {
													    if (confirm('Deseja realmente Remover este Registro?')) {
													        parent.location="<?php echo HOSTNAME.'request/delete/'.$row['id']; ?>";
													    }
													};
													</script>
												</form>
                                                </td>
                                            </tr>
		                                    <?php
	                                    }
	                                    ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
	                    <?php
}
?>