    <?php
    $students = [
        [ "name" => "John", "grades" => [
                "CCS112" => "85",
                "ITEW3" => "78",
                "ENG1" => "92"
            ]
        ],
        ["name" => "Mary", "grades" => [
                "CCS112" => "70",
                "ITEW3" => "68",
                "ENG1" => "72"
            ]
        ],
        ["name" => "Fernando Liwanag III", "grades" => [
                "CCS112" => "90",
                "ITEW3" => "90",
                "ENG1" => "90"
            ]
        ] ,
        ["name" => "Sponge",
            "grades" => [
                "CCS112" => "60",
                "ITEW3" => "68",
                "ENG1" => "65"
            ]
        ],
        ["name" => "Bob",
            "grades" => [
                "CCS112" => "50",
                "ITEW3" => "60",
                "ENG1" => "65"
            ]
        ]
    ];
        // Method to compute average and determine the student status
        function computeAverageAndStatus($grades) {
            $total = array_sum($grades);
            $count = count($grades);
            $average = $total / $count;
            $status = ($average >= 60) ? "Pass" : "Fail";
            return ["average" => $average, "status" => $status];
        }

        //Looping through students and displaying their grades and status   
         echo "<h1>Student Grades</h1>";
         foreach ($students as $student) {
         echo "Student: " . ($student['name']) . "<br>";
         echo "Grades: CCS112 - " . ($student['grades']['CCS112']) . 
             ", ITEW3 - " . ($student['grades']['ITEW3']) . 
             ", ENG1 - " . ($student['grades']['ENG1']) . "<br>";
            $result = computeAverageAndStatus($student['grades']);
            
            echo "Average: " . round($result['average']) . "<br>";
            echo "Status: " . $result['status'] . "<br>";
            echo "-------------------------------------- <br>";
    }
    ?>