<aside class="col-md-2 d-none d-md-block px-0 bg-light sidebar">
	<nav class="w-100 d-none d-md-block bg-light sidebar">
		<div id="accordion">
			<?php
				$menu_items = $this->menu_m->get_admin_menu_items();
				foreach ($menu_items as $key => $item) { ?>
			<div class="card">
				<div class="card-header py-1 px-1" id="<?='item-'.$item->menu_id;?>">
					<?php if($item->submenu !== null){ ?>
					<h5 class="mb-0">
						<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#<?='submenu-'.$item->menu_id;?>" aria-expanded="false" aria-controls="<?='submenu-'.$item->menu_id;?>">
							<?=$item->menu_title;?>
						</button>
					</h5>
				</div>
				<div id="<?='submenu-'.$item->menu_id;?>" class="collapse" aria-labelledby="<?='item-'.$item->menu_id;?>" data-parent="#accordion">
					<div class="card-body py-0 pr-0">
						<div id="<?='accordion-'.$item->menu_id;?>">
						<?php foreach ($item->submenu as $key => $sub) { ?>
							<div class="card">
								<div class="card-header py-1 px-1" id="<?='item-'.$item->menu_id.'-'.$sub->menu_id;?>">
									<?php if($sub->submenu !== null){ ?>
									<h5 class="mb-0">
										<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#<?='submenu-'.$item->menu_id.'-'.$sub->menu_id;?>" aria-expanded="false" aria-controls="<?='submenu-'.$item->menu_id.'-'.$sub->menu_id;?>"><?=$sub->menu_title;?></button>
									</h5>
								</div>
								<div id="<?='submenu-'.$item->menu_id.'-'.$sub->menu_id;?>" class="collapse" aria-labelledby="<?='item-'.$item->menu_id.'-'.$sub->menu_id;?>" data-parent="#<?='accordion-'.$item->menu_id;?>">
									<div class="card-body py-0 pr-0">
										<div id="<?='accordion-'.$sub->menu_id;?>">
											<?php foreach ($sub->submenu as $key => $subsub) { ?>
												<div class="card">
													<div class="card-header py-1 px-1" id="<?='item-'.$item->menu_id.'-'.$sub->menu_id.'-'.$subsub->menu_id;?>">
														<?php if($subsub->submenu !== null){ ?>
														<h5 class="mb-0">
															<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#<?='submenu-'.$item->menu_id.'-'.$sub->menu_id.'-'.$subsub->menu_id;?>" aria-expanded="false" aria-controls="<?='submenu-'.$item->menu_id.'-'.$sub->menu_id.'-'.$subsub->menu_id;?>"><?=$subsub->menu_title;?></button>
														</h5>
													</div>
													<div id="<?='submenu-'.$item->menu_id.'-'.$sub->menu_id.'-'.$subsub->menu_id;?>" class="collapse" aria-labelledby="<?='item-'.$item->menu_id.'-'.$sub->menu_id.'-'.$subsub->menu_id;?>" data-parent="#<?='accordion-'.$sub->menu_id;?>">
														<div class="card-body">
																<div id="<?='accordion-'.$subsub->menu_id;?>">
																	<?php foreach ($subsub->submenu as $key => $ss_sub) { ?>
																		<div class="card">
																			<div class="card-header py-1 px-1" id="<?='item-'.$item->menu_id.'-'.$sub->menu_id.'-'.$subsub->menu_id.'-'.$ss_sub->menu_id;?>">
																				<h5 class="mb-0">
																					<a class="btn btn-link collapsed" href="<?=($ss_sub->link_type == '1')? site_url($ss_sub->menu_link) : $ss_sub->menu_link ?>"><?=$ss_sub->menu_title;?></a>
																				</h5>
																			</div>
																		</div>
																	<?php } ?>
																</div>
														</div>
														<?php } else { ?>
														<h5 class="mb-0">
															<a class="btn btn-link collapsed" href="<?=($subsub->link_type == '1')? site_url($subsub->menu_link) : $subsub->menu_link ?>"><?=$subsub->menu_title;?></a>
														</h5>
														<?php } ?>
													</div>
												</div>
											<?php } ?>
										</div>
									</div>
									<?php } else { ?>
									<h5 class="mb-0">
										<a class="btn btn-link collapsed" href="<?=($sub->link_type == '1')? site_url($sub->menu_link) : $sub->menu_link ?>"><?=$sub->menu_title;?></a>
									</h5>
									<?php } ?>
								</div>
							</div>
						<?php } ?>
						</div>
					</div>
					<?php } else { ?>
					<h5 class="mb-0">
						<a class="btn btn-link collapsed" href="<?=($item->link_type == '1')? site_url($item->menu_link) : $item->menu_link ?>"><?=$item->menu_title;?></a>
					</h5>	
					<?php } ?>
				</div>
			</div>
			<?php } ?>
		</div>
	</nav>
</aside>