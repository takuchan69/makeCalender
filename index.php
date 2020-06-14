<?php
echo 'first step to make calendar';
//target month
$t= '2020-07';
$thisMonth = new DateTime($t);
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
                             <th class='red'>sun</th>
                             <th class='black'>mon</th>
                             <th class='black'>tue</th>
                             <th class='black'>wed</th>
                             <th class='black'>thu</th>
                             <th class='black'>fri</th>
                             <th class='blue'>sat</th>
                        </thead>
                        <tbody>
                            <tr>
                                <?php foreach($previousMonth as $day):?>
                                   <td class='gray'><?=sprintf('%d',$day->format('d'));?></td>
                                <?php endforeach;?>
                                <?php foreach($currentMonth as $day):?>
                                      <?php if($day->format('w') === '6'):?>
                                      <td class='blue'><?=sprintf('%d',$day->format('d'));?></td></tr>
                                    <?php elseif($day->format('w') === '0'):?>
                                      <td class='red'><?=sprintf('%d',$day->format('d'));?></td>
                                    <?php else :?>
                                      <td class='black'><?=sprintf('%d',$day->format('d'));?></td>
                                    <?php endif;?>
                                <?php endforeach ;?>
                                <?php foreach($nextMonth as $day):?>
                                   <td class='gray'><?=sprintf('%d',$day->format('d'));?></td>
                                <?php endforeach;?>
                            </tr>
                      </tbody>
                     </table>
             </section>
       </body>
</html>
