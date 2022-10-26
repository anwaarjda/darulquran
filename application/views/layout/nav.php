<div class="left side-menu">
	<div class="sidebar-inner slimscrollleft">
		<div id="sidebar-menu">
			<ul>
				<li id="dashboard_active">
					<a href="<?=site_url('Dashboard')?>">
						<i class="fa fa-dashboard"></i> <span>ڈیش بورڈ</span>
					</a>
				</li>
				<li class="has_sub">
					<a href="javascript:void(0);"><i class="fa fa-gear"></i><span> ترتیبات </span></a>
					<ul class="list-unstyled">
						<?php if ($this->group=='admin'): ?>
						<li id="user_active">
							<a href="<?=site_url('User')?>">
								<i class="fa fa-arrow-circle-left"></i><span>یوزر</span>
							</a>
						</li>
						<?php endif;?>
						<li id="classes_active">
							<a href="<?=site_url('Classes/classes')?>">
								<i class="fa fa-arrow-circle-left"></i><span>کلاس</span>
							</a>
						</li>

						<li id="new_subject_active">
							<a href="<?=site_url('Subject/new_subject')?>">
								<i class="fa fa-arrow-circle-left"></i><span>نیا مضمون بنائیں</span>
							</a>
						</li>

						<li id="subject_active">
							<a href="<?=site_url('Subject')?>">
								<i class="fa fa-arrow-circle-left"></i><span>مضامین ترتیب دیں</span>
							</a>
						</li>
						<li id="area_active">
							<a href="<?=site_url('Area')?>">
								<i class="fa fa-arrow-circle-left"></i><span>علاقہ</span>
							</a>
						</li>
						<?php if ($this->group=='admin'): ?>
						<li id="dq_years_active">
							<a href="<?=site_url('Dq_years')?>">
								<i class="fa fa-arrow-circle-left"></i><span>سال ترتیب دیں</span>
							</a>
						</li>
						<?php endif;?>
					</ul>
				</li>
				<li id="student_active">
					<a href="<?=site_url('Student')?>">
						<i class="fa fa-list-alt"></i><span>داخلے</span>
					</a>
				</li>
				<li class="has_sub">
					<a href="javascript:void(0);"><i class="fa fa-money"></i><span> فیس </span></a>
					<ul class="list-unstyled">
						<?php if ($this->group=='admin'): ?>
						<li id="annual_fees_active">
							<a href="<?=site_url('Fees/annual_fees')?>">
								<i class="fa fa-arrow-circle-left"></i><span> سالانہ فیس کی ترتیب</span>
							</a>
						</li>
						<?php endif;?>
						<li id="receive_fees_active">
							<a href="<?=site_url('Fees')?>">
								<i class="fa fa-arrow-circle-left"></i><span> فیس وصولی</span>
							</a>
						</li>
						<li id="fees_list_active">
							<a href="<?=site_url('Fees/fees_list')?>">
								<i class="fa fa-arrow-circle-left"></i><span> فہرست</span>
							</a>
						</li>
					</ul>
				</li>
				<li id="attendance_active">
					<a href="<?=site_url('Attendance')?>">
						<i class="fa fa-check"></i><span> حاضری</span>
					</a>
				</li>
				<li id="teacher_active">
					<a href="<?=site_url('Teacher')?>">
						<i class="fa fa-user"></i> <span>ممتحن</span>
					</a>
				</li>
				<li id="result_active">
					<a href="<?=site_url('Result')?>">
						<i class="icon icon-book-open"></i><span>رزلٹ</span>
					</a>
				</li>
				<li id="search_active">
					<a href="<?=site_url('Search')?>">
						<i class="fa fa-search"></i> <span>تلاش</span>
					</a>
				</li>
				<li id="extension_active">
					<a href="<?=site_url('Extension')?>">
						<i class="fa fa-phone"></i> <span>ایکسٹینشن</span>
					</a>
				</li>

				<li class="has_sub"><a href="<?= site_url('Auth/logout') ?>" style="font-size: 26px;background-color: #ff391f" >
						<i class="fa fa-power-off"></i> <span>لاگ آوُٹ</span> </a>
				</li>
			</ul>
		</div>
	</div>
</div>
