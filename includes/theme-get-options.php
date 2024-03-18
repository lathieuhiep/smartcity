<?php
// get option contact list
function smartcity_get_opt_contact_list()
{
	$contact_list = smartcity_get_option('opt_contact_list');

	var_dump($contact_list);
}