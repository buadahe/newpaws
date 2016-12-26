<table class="notifications">
	<thead>
		<tr>
			<th class="icon"></th>
			<th><?php _e( 'Notification', 'buddypress' ); ?></th>
			<th><?php _e( 'Date Received', 'buddypress' ); ?></th>
			<th><?php _e( 'Actions',    'buddypress' ); ?></th>
		</tr>
	</thead>

	<tbody>

		<?php while ( bp_the_notifications() ) : bp_the_notification(); ?>

			<tr>
				<td class="icon"><span class="glyphicon glyphicon-chevron-right"></span></td>
				<td><?php bp_the_notification_description();  ?></td>
				<td class><span><?php bp_the_notification_time_since();   ?></span></td>
				<td class="actions"><?php bp_the_notification_action_links(); ?></td>
			</tr>

		<?php endwhile; ?>

	</tbody>
</table>