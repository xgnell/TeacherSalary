<?php

namespace App\Constants;

class HistoryKPIStatus {
	const Unprocess = 0;
	const Updated = 1;
	const Edited = 2;

	static function getName($gender) {
		switch ($gender) {
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

		dd("Invalid history kpi status value");
		return "";
	}
}