mysql -u root -proot -h localhost azaz < azaz.sql

if NOT ["%errorlevel%"]==["0"] (
    pause
    exit /b %errorlevel%
)
