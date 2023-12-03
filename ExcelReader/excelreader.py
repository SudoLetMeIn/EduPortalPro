import pandas as pd
import mysql.connector
from sqlalchemy import create_engine

# MySQL database connection configuration
db_server = "localhost"
db_user = "root"
db_pass = ""
db_name = "student"
db_table_name = "students"

# Excel file path
excel_file_path = "./uploads/input.xlsx"

def read_excel_to_dataframe(file_path):
    df = pd.read_excel(file_path)
    return df

def connect_to_mysql():
    return mysql.connector.connect(
        host=db_server,
        user=db_user,
        passwd=db_pass,
        database=db_name
    )

def write_to_mysql(dataframe, table_name, con):
    cursor = con.cursor()
    for _, row in dataframe.iterrows():
        cursor.execute(f"INSERT INTO {table_name} (name, phone, class, monthly_pay, payment_left, enrolled_date, total_months)"
                       "VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       (row['name'], row['phone'], row['class'], row['monthly_pay'],
                        row['payment_left'], row['enrolled_date'], row['total_months']))

    con.commit()
    cursor.close()

def main():
    excel_data = read_excel_to_dataframe(excel_file_path)
    mysql_conn = connect_to_mysql()
    write_to_mysql(excel_data, db_table_name, mysql_conn)
    mysql_conn.close()

if __name__ == "__main__":
    main()
