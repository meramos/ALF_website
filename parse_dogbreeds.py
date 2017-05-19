#Parse file with dog breeds in english and spanish
#then create SQL instructions to insert data into Catalog table of ALF_DB

import io

with io.open("dogbreeds_enspa.csv","r",encoding='latin1') as fi:
    filetxt = fi.read()

filelist_lines = filetxt.split("\n")
SQLcode="SET names UTF8;\n"

for line in filelist_lines:

    line_sep = line.split(",")
    english = line_sep[0]
    spanish = line_sep[1]

    SQLcode = SQLcode + "INSERT INTO catalog (category,table_name, type, spanish_value, english_value, description) VALUES ('animal','dog', 'breed','"+spanish+"','"+english+"','breed of the pet');\n"

with io.open("SQLdogbreeds","w",encoding='utf8') as fo:

    fo.write(SQLcode)

fi.close()
fo.close()

print SQLcode
