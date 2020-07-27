<?php
$data = json_decode(file_get_contents('http://om-sv.ru/progtest/arData.txt'), true)["SECTIONS"];

$columns = 5;

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
    <?php for ($i=0; $i < count($data1) / $columns; $i++): ?>
        <tr>
            <?php for ($j=0; $j < $columns; $j++): ?>
                <?php $index = $i + intdiv( count( $data1), $columns) * $j + $j; ?>
                <?php if (array_key_exists($index, $data1)): ?>
                    <td>
                        <?php if ($data1[$index]["type"] == "link"): ?>
                            <a href="<?= $data1[$index]["href"] ?>">
                        <?php endif; ?>
                        <?= $data1[$index]["value"] ?>
                        <?php if ($data1[$index]["type"] == "link"): ?>
                            </a>
                        <?php endif; ?>    
                    </td>
                <?php endif; ?>
            <?php endfor; ?>
        </tr>
    <?php endfor; ?>
</table>
