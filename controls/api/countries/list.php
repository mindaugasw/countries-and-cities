<?php

$countries = CountryRepository::GetAll();
API::Json($countries);