<?php

namespace App\Constants;

class Gender {
	const Male = 0;
	const Female = 1;
	const Other = 2;

	static function getName($gender) {
		switch ($gender) {
			case Self::Male:
				return "Male";
				break;
			case Self::Female:
				return "Female";
				break;
			case Self::Other:
				return "Other";
				break;
		}

		dd("Invalid gender value");
		return "";
	}
}