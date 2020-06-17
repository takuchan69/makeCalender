<?php
require_once(__DIR__.'/functions.php');
echo 'first step to make calendar';
define('TODAY','today');
//get target month using try catch
try{
  if(!isset($_GET['t']) || !preg_match('/\A\d{4}-\d{2}\z/',$_GET['t'])){
    throw new Exception();
  }
  $thisMonth = new DateTime($_GET['t']);
}catch(Exception $e){
  //when null $thisMonth is 'this month'
  $thisMonth = new DateTime('first day of this month');
}
$thisMonthObjct = clone $thisMonth;
$prev = $thisMonthObjct->modify('-1 month')->format('Y-m');
var_dump($prev);
$thisMonthObjct = clone $thisMonth;
$next = $thisMonthObjct->modify('+1 month')->format('Y-m');
var_dump($next);
//get target month as String
$yearMonth = sprintf($thisMonth->format('F Y'));
//express prvious and next month as string
$nextYearMonth = $yearMonth.'+1 month';
$previousYearMonth = $yearMonth.'-1 month';
//get three period of month
$currentMonth = new DatePeriod(new DateTime('first day of'.$yearMonth),new DateInterval('P1D'),new DateTime('first day of'.$nextYearMonth));
$previousMonth = new DatePeriod(new DateTime('last sunday of'.$previousYearMonth),new DateInterval('P1D'),new DateTime('first day of '.$yearMonth));
$nextMonth = new DatePeriod(new DateTime('first day of '.$nextYearMonth),new DateInterval('P1D'),new DateTime('first sunday of '.$nextYearMonth));

?>
<!DOCTYPE html>
       <head>
             <meta charset="UTF-8">
             <meta name='keywords' content='practice for php'>
             <title>calendar</title>
             <link rel="stylesheet" href="calendar.css">
       </head>
       <body>
             <header>
                    <h1>Head Title of Calendar</h1>
             </header>
             <section id='container'>
                     <table>
                       <thead>
                         <td colspan='2' class='blue'><a href='/?t=<?=$prev; ?>'> &laquo;</a></td>
                         <td colspan='3' class='gray'><a href='/?t=<?=TODAY;?>'>Today</a></td>
                         <td colspan='2' class='blue'><a href='/?t=<?=$next;?>'> &raquo;</a></td>
                       </thead>
                         <tr>
                             <th class='red'>sun</th>
                             <th class='black'>mon</th>
                             <th class='black'>tue</th>
                             <th class='black'>wed</th>
                             <th class='black'>thu</th>
                             <th class='black'>fri</th>
                             <th class='blue'>sat</th>
                        </tr>
                        <tbody>

                            <tr>
                                <?php foreach($previousMonth as $day):?>
                                   <td class='gray'><?=sprintf('%d',$day->format('d'));?></td>
                                <?php endforeach;?>
                                <?php foreach($currentMonth as $day):?>
                                      <?php if($day->format('w') === '6'):?>
                                      <td class='blue'><?=sprintf('%d',$day->format('d'));?></td></tr>
                                    <?php elseif($day->format('w') === '0'):?>
                                      <tr><td class='red'><?=sprintf('%d',$day->format('d'));?></td>
                                    <?php else :?>
                                      <td class='black'><?=sprintf('%d',$day->format('d'));?></td>
                                    <?php endif;?>
                                <?php endforeach ;?>
                                <?php foreach($nextMonth as $day):?>
                                   <td class='gray'><?=sprintf('%d',$day->format('d'));?></td>
                                <?php endforeach;?>
                            </tr>
                      </tbody>
                      <tfoot>
                          <td colspan='7' class='blue'><?=$yearMonth;?></td>
                      </tfoot>
                     </table>

             </section>
       </body>
</html>
