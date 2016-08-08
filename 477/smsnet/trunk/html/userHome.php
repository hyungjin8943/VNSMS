<!DOCTYPE html>
<html>
    <head>
        <title>Data Home</title>
        <link rel="stylesheet" type="text/css" href="main.css">
    </head>
    <body>
        <h1>Hello Peter</h1>
        <div id="container">
            <div id="center">
                <h2>Projects</h2>
                <h3>Vietnam</h3>
                <h4>Recent Data</h4>
		<p>Most recent message:<?php
			$ch = curl_init("http://www.example.com/");
			$fp = fopen("example_homepage.txt" ,"w");
			
			curl_setopt($ch, CURLOPT_FILE, $fp);
			curl_setopt($ch, CURLOPT_HEADER, 0);

			curl_exec($ch);
			curl_close($ch);
			fclose($fp);
			//echo " test2";
		?></p>
                    <div id="tableDiv">
                        <table>
                            <tr>
                                <td>
                                    <table border="1">
                                        <tr>
                                            <th>Clinic</th>
                                            <th>Age</th>
                                            <th>Gender</th>
                                            <th>Time</th>
                                            <th>Code</th>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>11</td>
                                            <td>M</td>
                                            <td>12:34:56</td>
                                            <td>314159</th>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>6</td>
                                            <td>F</td>
                                            <td>12:34:56</td>
                                            <td>3134159</th>
                                                </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>8</td>
                                            <td>M</td>
                                            <td>12:34:56</td>
                                            <td>31459</th>
                                                </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>6</td>
                                            <td>M</td>
                                            <td>12:34:56</td>
                                            <td>234359</th>
                                                </tr>
                                    </table>
                                </td>
                                <td>
                                    <a href="more_data.html">View more data</a>
                                    <br />
                                    <a href="heatmap.html">View heatmap</a>
                                    
                                </td>
                            </tr>
                            
                    </table>
                    </div>
            </div>

            <div id="rightRail">
                <h2>Administration</h2>
                <ul>
                    <li><a href="admin_projects.html">Manage Projects</a></li>
                    <li><a href="admin_users.html">Manage Users</a></li>
                </ul>
            </div>
        </div>
    </body>
</html>
