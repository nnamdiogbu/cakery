# cakery


Composer Installation

## Installation Instructions

### Step 1: Install Composer

Composer is a dependency manager for PHP. Follow these steps to install Composer on your system:

1. **Download the Composer Installer**

    ```sh
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    ```

2. **Verify the Installer**

    ```sh
    php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
    ```

    You should see the message `Installer verified`. If you see `Installer corrupt`, it means the file was not downloaded correctly and the setup process will halt. In this case, try downloading the installer again.

3. **Install Composer**

    ```sh
    php composer-setup.php
    ```

4. **Remove the Installer**

    ```sh
    php -r "unlink('composer-setup.php');"
    ```

After these steps, Composer should be installed on your system. You can check the installation by running:

```sh
composer --version

