<?php
/*
Template Name: Шаблон для страницы Вендорам
*/
?>
<?php get_header(); ?>
<section class="block-main">
		<div class="wrapper">
			<div class="text-1"><?php the_field('text_1')?></div>
			<h1><?php the_field('text_2')?></h1>
			<div class="text-2"><?php the_field('text_3')?></div>

			<div class="list-triggers">
				<?php while ( have_rows('triggers') ) { the_row(); ?>
					<div class="item">
						<div class="photo">
							<img src="<?php the_sub_field('image')?>" alt="">
						</div>
						<div class="name"><?php the_sub_field('name')?></div>
						<div class="text">
						<?php the_sub_field('text')?>
						</div>
						<div class="button">
							<a href="<?php the_sub_field('link')?>" target="_blank"><?php pll_e('Подробнее')?></a>
						</div>
					</div>
                <?php } ?>
			</div>

			<div class="buttons">
				<a class="b-btn b-btn-orange" href="#mainForm" onclick="Index.changeSubject('<?php pll_e('Получить демо')?>')" data-fancybox><?php pll_e('Получить демо')?></a>
				<a class="b-btn" href="#mainForm" onclick="Index.changeSubject('<?php pll_e('Консультация менеджера')?>')" data-fancybox><?php pll_e('Консультация менеджера')?></a>
			</div>
		</div>
	</section>

	<section class="block-solved">
		<div class="wrapper">
			<h2 class="title"><?php the_field('solved_title')?></h2>

			<div class="list-solved">
				<?php while ( have_rows('solved_list') ) { the_row(); ?>
					<div class="item"><?php the_sub_field('text')?></div>
				<?php } ?>
			</div>
		</div>
	</section>

	<section class="block-products">
		<div class="wrapper">
			<div class="content">
				<h2 class="title title_fix_padding"><?php the_field('products_title')?></h2>
				<div class="subtitle-1  subtitle_fix_padding"><?php the_field('products_text1')?></div>
				<?php /*<div class="subtitle-2"><?php the_field('products_text2')?></div>*/ ?>

				<div class="list-info">
					<?php while ( have_rows('products_list') ) { the_row(); ?>
						<div class="item">
							<div class="photo">
								<img src="<?php the_sub_field('image')?>" alt="">
							</div>
							<div class="info">
								<div class="name"><?php the_sub_field('name')?></div>
								<div class="text"><?php the_sub_field('text')?></div>
                                <?php if (!empty(get_sub_field('example_name'))) { ?>
								<div class="example">
									<div class="text-1"><?php pll_e('Пример использования')?>:</div>
									<div class="text-2"><?php the_sub_field('example_name')?></div>
									<div class="text-3"><?php the_sub_field('example_short_text')?></div>
                                    <?php if (!empty(get_sub_field('example_full_text'))) { ?>
									<div class="hidden-text"><?php the_sub_field('example_full_text')?></div>
									<div class="link"><a href="#" data-remodal-target="modal-text" class="open-text"><?php pll_e('Показать полностью')?></a></div>
                                    <?php } ?>
								</div>
                                <?php } ?>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</section>

	<section class="block-analytics">
		<div class="wrapper">
			<h2 class="title  title_fix_padding"><?php the_field('analytics_title')?></h2>
			<div class="subtitle-1 subtitle_fix_padding"><?php the_field('analytics_text1')?></div>
			<?php /*<div class="subtitle-2"><?php the_field('analytics_text2')?></div>*/ ?>

			<div class="list-info">
				<?php while ( have_rows('analytics_list') ) { the_row(); ?>
					<div class="item">
						<div class="photo">
							<img src="<?php the_sub_field('image')?>" alt="">
						</div>
						<div class="info">
							<div class="name"><?php the_sub_field('name')?></div>
							<div class="text"><?php the_sub_field('text')?></div>
    <?php if (!empty(get_sub_field('example_name'))) { ?>
							<div class="example">
								<div class="text-1"><?php pll_e('Пример использования')?>:</div>
								<div class="text-2"><?php the_sub_field('example_name')?></div>
								<div class="text-3"><?php the_sub_field('example_short_text')?></div>
        <?php if (!empty(get_sub_field('example_full_text'))) { ?>
								<div class="hidden-text"><?php the_sub_field('example_full_text')?></div>
								<div class="link"><a href="#" data-remodal-target="modal-text" class="open-text"><?php pll_e('Показать полностью')?></a></div>
        <?php } ?>
							</div>
    <?php } ?>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</section>

	<section class="block-products">
		<div class="wrapper">
			<div class="content">
				<h2 class="title title_fix_padding"><?php the_field('control_title')?></h2>
				<div class="subtitle-1 subtitle_fix_padding"><?php the_field('control_text1')?></div>
				<?php /*<div class="subtitle-2"><?php the_field('control_text2')?></div>*/ ?>

				<div class="list-info">
					<?php while ( have_rows('control_list') ) { the_row(); ?>
						<div class="item">
							<div class="photo">
								<img src="<?php the_sub_field('image')?>" alt="">
							</div>
							<div class="info">
								<div class="name"><?php the_sub_field('name')?></div>
								<div class="text"><?php the_sub_field('text')?></div>
    <?php if (!empty(get_sub_field('example_name'))) { ?>
								<div class="example">
									<div class="text-1"><?php pll_e('Пример использования')?>:</div>
									<div class="text-2"><?php the_sub_field('example_name')?></div>
									<div class="text-3"><?php the_sub_field('example_short_text')?></div>
        <?php if (!empty(get_sub_field('example_full_text'))) { ?>
									<div class="hidden-text"><?php the_sub_field('example_full_text')?></div>
									<div class="link"><a href="#" data-remodal-target="modal-text" class="open-text"><?php pll_e('Показать полностью')?></a></div>
        <?php } ?>
								</div>
    <?php } ?>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</section>

	<section class="block-partners">
		<div class="wrapper">
			<h2 class="title"><?php the_field('partners_title')?></h2>

			<div class="list-partners">
				<?php while ( have_rows('partners_logo') ) { the_row(); ?>
					<div class="item"><picture><img src="<?php the_sub_field('logo')?>" alt=""></picture></div>
				<?php } ?>
			</div>
		</div>
	</section>

	<section class="block-benefits">
		<div class="wrapper">
			<h2 class="title"><?php the_field('benefits_title')?></h2>

			<div class="list-benefits">
				<?php while ( have_rows('benefits_list') ) { the_row(); ?>
					<div class="item">
						<div class="text">
							<div class="name"><?php the_sub_field('name')?></div>
							<div class="desc"><?php the_sub_field('text')?></div>
						</div>
						<div class="icon">
							<img src="<?php the_sub_field('icon')?>" alt="">
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</section>

	<?php /*<section class="block-consult">
		<div class="wrapper">
			<div class="consult">
				<div class="avatar">
					<picture><img src="<?php the_field('consult_avatar')?>" alt=""></picture>
				</div>
				<div class="text-1"><?php the_field('consult_text_1')?></div>
				<div class="text-2"><?php the_field('consult_text_2')?></div>
				<div class="button">
					<a class="b-btn" href="#mainForm" onclick="Index.changeSubject('Консультация менеджера')" data-fancybox>Консультация менеджера</a>
				</div>
			</div>
		</div>
	</section>

	<section class="block-reviews">
		<div class="wrapper">
			<h2 class="title">Отзывы наших клиентов</h2>

			<div class="slider-reviews">
				<?php while ( have_rows('review_list') ) { the_row(); ?>
					<div>
						<div class="item">
							<div class="review-text">
								<?php the_sub_field('text')?>
							</div>
							<div class="review-bottom">
								<div class="rating">
									<div class="num"><?php the_sub_field('rating')?></div>
									<div class="stars">
									<?php $rating = round(get_sub_field('rating'));
										for($i = 1; $i <= 5; $i++) {
									?>
									<?php if($i <= $rating) { ?>
										<i class="active"></i>
									<?php }else{ ?>
										<i></i>
									<?php } 
										}
									?>
									</div>
								</div>
								<div class="client">
									<div class="logo"><picture><img src="<?php the_sub_field('logo')?>" alt=""></picture></div>
									<div class="name">
										<b><?php the_sub_field('name')?></b>
										<span><?php the_sub_field('work')?></span>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</section>*/ ?>

	<section class="block-try">
		<div class="wrapper">
			<div class="content">
				<div class="wrap">
					<div class="text-1"><?php the_field('pricer_title')?></div>
					<div class="text-2"><?php the_field('pricer_text')?></div>
					<div class="button">
						<a class="b-btn" href="#mainForm" onclick="Index.changeSubject('<?php pll_e('Получить демо')?>')" data-fancybox><?php pll_e('Получить демо')?></a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<div class="remodal modal-text" data-remodal-id="modal-text" id="modal-text" data-remodal-options="hashTracking: false">
		<button data-remodal-action="close" class="remodal-close"></button>
		
		<div class="name"></div>
		<div class="text"></div>
		<div class="button">
			<a class="b-btn b-btn-orange" href="#mainForm" onclick="Index.changeSubject('<?php pll_e('Получить демо')?>')" data-fancybox><?php pll_e('Получить демо')?></a>
		</div>
	</div>
<?php get_footer(); ?>