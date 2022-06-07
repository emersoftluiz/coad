<?php
function display_request_type_form($request_type = '', $details = '') {
	$edit = is_array($request_type);
    ?>
	<form method="POST" action="<?php echo $edit ? HOSTNAME.'request_type/update' : HOSTNAME.'request_type/insert'; ?>">
	<?php
	if ($edit) {
		echo '<input type="hidden" name="id" value="'. htmlspecialchars($request_type['id']).'" />';
	}
	?>
	  <div class="form-row">
		<div class="form-group col-md-6">
		  <label for="name">Nome</label>
		  <input type="text" class="form-control" id="name" name="name" placeholder="Nome"
		  <?php if($details) echo 'readonly';?> value="<?php echo htmlspecialchars($edit ? $request_type['name'] : ''); ?>"  required>
		</div>
	  </div>
	  <?php
	  if($details){
		  ?><input type="button" class="btn btn-primary" onclick="location.href='<?php echo HOSTNAME;?>request_type/edit/<?php echo $request_type['id'];?>';" value="Alterar Tipo de Solicitação" /><?php
	  } else {
		  ?><button type="submit" class="btn btn-warning"><?php echo $edit ? 'Alterar' : 'Adicionar'; ?> Tipo de Solicitação</button><?php
	  }
	  if ($edit){
		  ?>
		  <input class="btn btn-danger" type="button" id="delete" value='Remover Tipo de Solicitação' />
		  <script type="text/javascript">
		  document.getElementById('delete').onclick = function () {
		      if (confirm('Deseja realmente Remover este Registro?')) {
		          parent.location="<?php echo HOSTNAME.'request_type/delete/'.$request_type['id']; ?>";
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

function display_request_types($cat_array) {
	if (!is_array($cat_array)) {
		do_html_mensagem('Nenhum Tipo de Solicitação foi encontrado na base de dados.', 'warning');
        return;
    }
    ?>
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Lista de Tipos de Solicitação</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nome</th>
                                                <th>Menu</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nome</th>
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
                                                <td><?php echo $row['name'];?></td>
                                                <td>
												<form id="form<?php echo $i;?>" method="post">
												    <input type="button" class="btn btn-success btn-sm" onclick="location.href='<?php echo HOSTNAME;?>request_type/details/<?php echo $row['id'];?>';" value="Detalhes" />
												    <input type="button" class="btn btn-warning btn-sm" onclick="location.href='<?php echo HOSTNAME;?>request_type/edit/<?php echo $row['id'];?>';" value="Alterar" />
													<input class="btn btn-danger btn-sm" type="button" id="delete<?php echo $i;?>" value='Remover' />
													<script type="text/javascript">
													document.getElementById('delete<?php echo $i;?>').onclick = function () {
													    if (confirm('Deseja realmente Remover este Registro?')) {
													        parent.location="<?php echo HOSTNAME.'request_type/delete/'.$row['id']; ?>";
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
