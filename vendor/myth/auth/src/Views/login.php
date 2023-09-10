<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>

<div class="container-xxl">
	<div class="authentication-wrapper authentication-basic container-p-y">
		<div class="authentication-inner py-4">
			<div class="card">
				<div class="card-body">
					<div class="app-brand justify-content-center mt-2">
						<a href="/" class="app-brand-link gap-2">
							<span class="app-brand-logo">
							<img src="logo.png" alt="" style="width: 300px;">
							</span>
						</a>
					</div>

					<h4 class="mb-1">Welcome to Goodyear Indonesia!</h4>
					<p class="mb-4">Please sign-in to your account and start the adventure</p>

					<form action="<?= url_to('login') ?>" method="post">
						<?= csrf_field() ?>

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
