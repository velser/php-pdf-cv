<?php
require('vendor/autoload.php');

$title = ['Name Surname (age)', 'City, Country', 'Full-Stack developer'];
$description = "I like coding. And I like writing tools for automatization. I want to become best developer in the world.";

$hardSkills = array_unique(['PHP', 'ReactJS', 'MySQL', 'Nginx', 'Symfony']);

$softSkills = array_unique(['Team leading', 'Architecturing',]);

$otherSkills = array_unique(['Angular', 'Phalcon',]);

$hardSkills = array_map(function ($value) {
    return '- ' . $value;
}, $hardSkills);

$softSkills = array_map(function ($value) {
    return '- ' . $value;
}, $softSkills);

usort($hardSkills, function ($a, $b) {
    return strtolower($a) > strtolower($b);
});

usort($softSkills, function ($a, $b) {
    return strtolower($a) > strtolower($b);
});

usort($otherSkills, function ($a, $b) {
    return strtolower($a) > strtolower($b);
});

class Flow
{
    private $title;
    private $from;
    private $to;
    private $position;

    public function __construct(string $title, DateTime $from, $to = 'present', $position = null)
    {
        $this->title = $title;
        $this->from = $from;
        $this->to = $to;
        $this->position = $position;
    }

    public function __toString()
    {
        $formattedText = sprintf("%s\n%s - ", $this->title, $this->from->format('Y.m'));

        if ($this->to instanceof DateTime) {
            $formattedText .= $this->to->format('Y.m');
        } else {
            $formattedText .= $this->to;
        }

        if ($this->position !== null) {
            $formattedText .= "\n" . $this->position;
        }

        return $formattedText;
    }
}

$flows[] = new Flow('My first job', new DateTime('2008-09'), new DateTime('2013-02'), 'Junior developer');
$flows[] = new Flow('Second job', new DateTime('2010-02'), new DateTime('2015-06'),
    'PHP Full-Stack Developer, Team Lead');

$pdf = new TCPDF();
$pdf->setFont('courier', '', 9);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->setMargins(5, 5);
$pdf->addPage();
$pdf->setFont('courier', 'b', 9);
$pdf->cell(200, 0, '/me/about', 'T,B', 1, 'L', 0, null, 0, false, 'T', 'T');
$pdf->setFont('courier', '', 8);
$pdf->setCellPaddings(5, 2, 10, 7);
$pdf->MultiCell(70, 30, implode($title, "\n\n"), 0, 'L', false, 0);
$pdf->MultiCell(130, 30, $description, 0, 'L', false, 1);
$pdf->setCellPaddings(1, 0, 0, 0);
$pdf->setFont('courier', 'b', 9);
$pdf->cell(100, 0, '/me/skills?type=hard&orderBy=name:ASC', 'T,B', 0, 'L', 0, null, 0, false, 'T', 'T');
$pdf->cell(100, 0, '/me/skills?type=soft&orderBy=name:ASC', 'T,B,L', 1, 'L', 0, null, 0, false, 'T', 'T');
$pdf->setFont('courier', '', 8);
$pdf->setCellPaddings(5, 2, 5);
$chunks = array_chunk($hardSkills, (int)ceil(count($hardSkills) / 2));
$hardSkillsFirstColumn = $chunks[0];
$hardSkillsSecondColumn = $chunks[1];

//hard skills and soft skills. modify height by your need, default 117
$pdf->MultiCell(50, 117, implode($hardSkillsFirstColumn, "\n"), 0, 'L', false, 0);
$pdf->MultiCell(50, 117, implode($hardSkillsSecondColumn, "\n"), 0, 'L', false, 0);
$pdf->MultiCell(100, 117, implode($softSkills, "\n"), 'L', 'L', false, 1);
$pdf->setCellPaddings(1, 0, 0);
$pdf->setFont('courier', 'b', 9);
$pdf->cell(200, 0, '/me/skills?type=know-how&orderBy=name:ASC', 'T,B', 1, 'L', 0, null, 0, false, 'T', 'T');
$pdf->setFont('courier', '', 8);
$pdf->setCellPaddings(5, 2, 5, 7);
$pdf->MultiCell(200, 0, implode($otherSkills, ", ") . ', Other...', 0, 'L', false, 1);
$pdf->setCellPaddings(1, 0, 0, 0);
$pdf->setFont('courier', 'b', 9);
$pdf->cell(200, 0, '/me/flows?orderBy=to:ASC', 'T,B', 1, 'L', 0, null, 0, false, 'T', 'T');

$pdf->setCellPaddings(5, 2, 5, 5);

$pdf->setFont('courier', '', 8);
foreach ($flows as $flow) {
    $pdf->MultiCell(130, 0, (string)$flow, 0, 'L', false, 1);
}

$pdf->output();







