<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>

<div class="container-xxl">
	<div class="authentication-wrapper authentication-basic container-p-y">
		<div class="authentication-inner py-4">
			<div class="card">
				<div class="card-body">
					<div class="app-brand justify-content-center mb-4 mt-2">
						<a href="" class="app-brand-link gap-2">
							<span class="app-brand-logo demo">
								<svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z" fill="#7367F0" />
									<path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z" fill="#161616" />
									<path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z" fill="#161616" />
									<path fill-rule="evenodd" clip-rule="evenodd" d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z" fill="#7367F0" />
								</svg>
							</span>
							<span class="app-brand-text demo text-body fw-bold ms-1">Goodyear Indonesia</span>
						</a>
					</div>

					<h4 class="mb-1 pt-2">Welcome to Goodyear Indonesia!</h4>
					<p class="mb-4">Please sign-in to your account and start the adventure</p>

					<form action="<?= url_to('login') ?>" method="post">
						<!-- <?= csrf_field() ?> -->

					<?php if ($config->validFields === ['email']): ?>
						<div class="form-group">
							<label for="login"><?=lang('Auth.email')?></label>
							<input type="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?=lang('Auth.email')?>" autofocus />
							<div class="invalid-feedback">
								<?= session('errors.login') ?>
							</div>
						</div>
					<?php else: ?>
						<div class="mb-3">
							<label for="login" class="form-label"><?=lang('Auth.emailOrUsername')?></label>
							<input type="text" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?=lang('Auth.emailOrUsername')?>">
							<div class="invalid-feedback">
								<?= session('errors.login') ?>
							</div>
						</div>
					<?php endif; ?>

						<div class="mb-3 form-password-toggle">
							<div class="d-flex justify-content-between">
								<label for="password" class="form-label"><?=lang('Auth.password')?></label>
							</div>
							<div class="input-group input-group-merge">
								<input type="password" id="password" name="password" class="form-control  <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password"">
								<span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
								<div class="invalid-feedback">
									<?= session('errors.password') ?>
								</div>
							</div>
						</div>

					<?php if ($config->allowRemembering): ?>
						<div class="form-check">
							<label class="form-check-label">
								<input type="checkbox" name="remember" class="form-check-input" <?php if (old('remember')) : ?> checked <?php endif ?>>
								<?=lang('Auth.rememberMe')?>
							</label>
						</div>
					<?php endif; ?>

						<br>

						<!-- <button type="submit" class="btn btn-primary btn-block"><?=lang('Auth.loginAction')?></button> -->
						<div class="mb-3">
							<button class="btn btn-primary d-grid w-100" type="submit" >Sign in</button>
						</div>
					</form>
				</div>
			</div>

		</div>
	</div>
</div>

<?= $this->endSection() ?>
