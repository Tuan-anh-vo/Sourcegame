<tr>
	<th>Hạng</th>
	<th>Tên Tài Khoản</th>
	<th>Tổng Điểm</th>
	<th>Phần Thưởng</th>
</tr>
<?php if($top) { foreach ($top as $key => $value) {
	switch ($key) {
		case '0':
			$award = '20.000 Bạc Khóa x 20 - Trung - Đá Cường Hóa Thần x 50 ...';
			break;
		case '1':
			$award = '16.000 Bạc Khóa x 16 - Trung - Đá Cường Hóa Thần x 45 ...';
			break;
		case '2':
			$award = '12.000 Bạc Khóa x 12 - Trung - Đá Cường Hóa Thần x 40 ...';
			break;
		case '3':
			$award = '10.000 Bạc Khóa x 10 - Trung - Đá Cường Hóa Thần x 35 ...';
			break;
		case '4':
			$award = '8.000 Bạc Khóa x 8 - Trung - Đá Cường Hóa Thần x 30 ...';
			break;
		default:
			$award = '4.000 Bạc Khóa x 4 - Trung - Đá Cường Hóa Thần x 15 ...';
			break;
	}
?>
<tr>
	<td><?=$key+1?></td>
	<td><?=$value->username?></td>
	<td><?=$value->count_sum?></td>
	<td><?=CutText($award,30)?></td>
</tr>
<?php } }?>