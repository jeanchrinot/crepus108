<?php 

function getAllServices()
{
	$all_services = \App\Models\Service::where('status',true)->get(['id','name']);

	return $all_services;
}