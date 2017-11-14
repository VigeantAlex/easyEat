<footer id="footer">
	<div class="row">
		<div class="four columns">
			<?php dynamic_sidebar('footer-widgets-1'); ?>
		</div>
		<div class="four columns">
			<?php dynamic_sidebar('footer-widgets-2'); ?>
		</div>
		<div class="four columns">
			<?php dynamic_sidebar('footer-widgets-3'); ?>
		</div>

		<div class="twelve columns">
			<div class="copy">
				<p><?php echo ci_footer(); ?></p>
			</div>
		</div>
	</div>
</footer>

</div> <!-- #page -->

<?php wp_footer(); ?>

</body>
</html>