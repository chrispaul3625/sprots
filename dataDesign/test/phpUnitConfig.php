/**
*
* this is the php unit configuration
* @author Dom Kratos <mr.kratos85@gmail.com>
**/
<phpunit>
	<testsuites>
		<testsuite name="Sprots Data Design">
			<file>FavoritePlayerTest.php</file>
			<file>FavoriteTeamTest.php</file>
			<file>GameTest.php</file>
      <file>PlayerTest.php</file>
      <file>PlayerStatisticsTest.php</file>
      <file>ProfileTest.php</file>
      <file>SportTest.php</file>
      <file>StatisticTest.php</file>
      <file>TeamTest.php</file>
      <file>TeamStatisticTest.php</file>
		</testsuite>
	</testsuites>
	<filter>
		<whitelist processUncoveredFilesFromWhitelist="true">
			<directory suffix=".php">../php/classes</directory>
		</whitelist>
	</filter>
</phpunit>