<?php
$data = json_decode(file_get_contents('http://om-sv.ru/progtest/arData.txt'), true)["SECTIONS"];

foreach ($data as $key => $value) {
	$name[$key] = $value["NAME"];
}

array_multisort($name, SORT_ASC, $data);

$capital = "";

foreach ($data as $key => $value) {
	$firstletter = mb_substr($value["NAME"], 0, 1);
	if($firstletter != $capital)
	{
		$data1[] = ["type" => "letter", "value" => $firstletter];
	}
	$capital = $firstletter;
	$data1[] = ["type" => "link", "value" => $value["NAME"], "href" => $value["SECTION_PAGE_URL"]];

}

?>

<table class="lettr_list">
<?php for ($i=0; $i < count($data1) / 3; $i++): ?>
<tr>
<?php if (array_key_exists($i, $data1)): ?>
<td style="padding:4px;">
	<?php if ($data1[$i]["type"] == "link"): ?>
		<a href="<?= $data1[$i]["href"] ?>">
	<?php endif; ?>
	<?= $data1[$i]["value"] ?>
	<?php if ($data1[$i]["type"] == "link"): ?>
		</a>
	<?php endif; ?>
</td>
<?php endif; ?>
<?php if (array_key_exists( $i + intdiv( count( $data1), 3) + 1, $data1)): ?>
<td style="padding:4px;">
	<?php if ($data1[$i + intdiv( count( $data1), 3) + 1]["type"] == "link"): ?>
		<a href="<?= $data1[$i + intdiv( count( $data1), 3) + 1]["href"] ?>">
	<?php endif; ?>
	<?= $data1[$i + intdiv( count( $data1), 3) + 1]["value"] ?>
	<?php if ($data1[$i + intdiv( count( $data1), 3) + 1]["type"] == "link"): ?>
		</a>
	<?php endif; ?>
</td>
<?php endif; ?>
<?php if (array_key_exists( $i + intdiv( count( $data1), 3) * 2 + 2, $data1)): ?>
<td style="padding:4px;">
	<?php if ($data1[$i + intdiv( count( $data1), 3) * 2 + 2]["type"] == "link"): ?>
		<a href="<?= $data1[$i + intdiv( count( $data1), 3) * 2 + 2]["href"] ?>">
	<?php endif; ?>
	<?= $data1[$i + intdiv( count( $data1), 3) * 2 + 2]["value"] ?>
	<?php if ($data1[$i + intdiv( count( $data1), 3) * 2 + 2]["type"] == "link"): ?>
		</a>
	<?php endif; ?>
</td>
<?php endif; ?>
</tr>
<?php endfor; ?>
</table>
