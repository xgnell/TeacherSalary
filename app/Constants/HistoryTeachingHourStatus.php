<?php

namespace App\Constants;

class HistoryTeachingHourStatus {
	const Unprocess = 0;
	const Updated = 1;
	const Edited = 2;

	static function getName($status) {
		switch ($status) {
			case Self::Unprocess:
				return "Unprocess";
				break;
			case Self::Updated:
				return "Updated";
				break;
			case Self::Edited:
				return "Edited";
				break;
		}

		dd("Invalid history teaching hour status value");
		return "";
	}
}