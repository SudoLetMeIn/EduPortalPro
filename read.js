function processUploadedExcelFile() {
    const filePath = 'uploads/input.xlsx';

    fetch(filePath)
      .then(response => response.arrayBuffer())
      .then(data => {
        const workbook = XLSX.read(new Uint8Array(data), { type: "array" });

        const sql_queries = [];

        const sql_query = (student_data) => {
          return `INSERT INTO student.students (name, phone, class, monthly_pay, payment_left, enrolled_date, total_months) VALUES ('${student_data.name}','${student_data.phone}','${student_data.class}',${student_data.monthly_pay},${student_data.payment_left},'${student_data.enrolled_date}',${student_data.total_months});`;
        };

        const sheets = workbook.SheetNames;

        sheets.forEach((name) => {
          const worksheet = workbook.Sheets[name];
          const arrStudents = XLSX.utils.sheet_to_json(worksheet);
          arrStudents.forEach((student) => {
            sql_queries.push(sql_query(student));
          });
        });
		sql_queries.forEach((query) => {
			console.log(query);
		})
        sendQueriesToServer(sql_queries);
      })
      .catch(error => console.error('Error fetching the file:', error));
  }

  function sendQueriesToServer(queries) {
    const apiUrl = 'upload.php';

    const formData = new FormData();
    queries.forEach((query, index) => {
      formData.append(`query${index}`, query);
    });
    fetch(apiUrl, {
      method: 'POST',
      body: formData
    })
    .then(response => {
      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }
      return response.text();
    })
    .then(responseText => {
      console.log('Server response:', responseText);
    })
    .catch(error => console.error('Error sending queries to the server:', error));
  }