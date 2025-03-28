Color_Text()
{
  echo -e " \e[0;$2m$1\e[0m"
}

Echo_Red()
{
  echo $(Color_Text "$1" "31")
}

Echo_Green()
{
  echo $(Color_Text "$1" "32")
}

Gen_OpenAPI() {
    local directory="app/api"

    # 查找目录下的所有目录
    local modules=($(ls "$directory"))

    for item in "${modules[@]}"
    do
        local result=()
        local c="app/api/${item}/controller/"
        if [ -d "$c" ]; then
            result+=($c)
            c=("app/api/${item}/request/")
            if [ -d "$c" ]; then
                result+=($c)
            fi
            c=("app/api/${item}/response/")
            if [ -d "$c" ]; then
                result+=($c)
            fi
        fi

        c=("app/response/")
        if [ -d "$c" ]; then
            result+=($c)
        fi

        result+=($(Get_Bundles ${item}))

        # vendor/bin/openapi ${result[@]} -o public/apidoc/${item,,}.json -f json # bash 4.0 支持
        vendor/bin/openapi ${result[@]} -o public/apidoc/$(echo $item | tr '[:upper:]' '[:lower:]').json -f json
    done
}

Get_Bundles()
{
    local directory="app/bundles"
    local module=$1

    # 查找目录下的所有目录
    local bundles=($(ls "$directory"))

    local result=()
    for item in "${bundles[@]}"
    do
        local c="app/bundles/${item}/controller/${module}/"
        if [ -d "$c" ]; then
            result+=($c)
        fi
        c="app/bundles/${item}/request/"
        if [ -d "$c" ]; then
            result+=($c)
        fi
        c="app/bundles/${item}/response/"
        if [ -d "$c" ]; then
            result+=($c)
        fi
    done

    echo ${result[@]}
}
