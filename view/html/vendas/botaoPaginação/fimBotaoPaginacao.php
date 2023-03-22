<li class='page-item'>
						<?= $vendas = 'vendas' ?>
						<a onclick=" let vendas= 'vendas'; paginacaoBotao({$ultimo_reg},vendas)" class='page-link' href='#' aria-label='Next' id="clientes{$ultimo_reg}">
							<span aria-hidden='true'>&raquo;</span>
							<span class='sr-only'>Next</span>
						</a>
					</li>
				</ul>
			</nav>
		</div>
		<div class='col-md-2'>
			<p><b>Total encontrado {{total_regPaginacao}}<b></p> 
		</div> 