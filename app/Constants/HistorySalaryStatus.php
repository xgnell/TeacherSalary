<?php

namespace App\Constants;

class HistorySalaryStatus {
	const Unprocess = 0;
	const Pending = 1;
	const Issue = 2;
	const Confirmed = 3;
	const Paid = 4;

	static function getName($status) {
		switch ($status) {
			case Self::Unprocess:
				return "Unprocess";
				break;
			case Self::Pending:
				return "Pending";
				break;
			case Self::Issue:
				return "Issue";
				break;
			case Self::Confirmed:
				return "Confirmed";
				break;
			case Self::Paid:
				return "Paid";
				break;
		}

		dd("Invalid history kpi status value");
		return "";
	}
}