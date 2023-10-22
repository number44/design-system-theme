/*
Copyright © 2023 NAME HERE <EMAIL ADDRESS>
*/
package cmd

import (
	"fmt"
	"os"
	"path/filepath"
	"strings"

	"github.com/spf13/cobra"
)

// renameCmd represents the rename command
var renameCmd = &cobra.Command{
	Use:   "rename",
	Short: "A brief description of your command",
	Long: `A longer description that spans multiple lines and likely contains examples
and usage of using your command. For example:

Cobra is a CLI library for Go that empowers applications.
This application is a tool to generate the needed files
to quickly create a Cobra application.`,
	Run: func(cmd *cobra.Command, args []string) {
		fmt.Println("rename called")
		 err := replaceFiles("./src/blocks", ".js", ".tsx")
         if err != nil {
             fmt.Printf("Error renaming files: %v\n", err)
             return
         }
	},
}

func init() {
	rootCmd.AddCommand(renameCmd)
}

func replaceFiles(srcFolder, oldExt, newExt string) error {
    return filepath.Walk(srcFolder, func(path string, info os.FileInfo, err error) error {
        if err != nil {
            return err
        }
		fmt.Println(info.Name()) 

        if !info.IsDir() && strings.HasSuffix(info.Name(), oldExt) {
            newFilePath := strings.TrimSuffix(path, oldExt) + newExt
            fmt.Printf("Renaming %s to %s\n", path, newFilePath)
            if err := os.Rename(path, newFilePath); err != nil {
                return err
            }
		


        }
			if info.Name() == "index.tsx" {
                // Read the file contents
				fmt.Println("sss1")
				fmt.Println(info.Name())
				
				content, readErr := os.ReadFile(path)
                if readErr != nil {
                    return readErr
                }
                // Replace "XXXX" with "YYY"
				newString := `
				const data : any = metadata.name
				registerBlockType( data, {
				`
                newContent := strings.Replace(string(content), "registerBlockType( metadata.name, {", newString, -1)

                // Write the modified content back to the file
                writeErr := os.WriteFile(path, []byte(newContent), 0644)
                if writeErr != nil {
                    return writeErr
                }
                fmt.Printf("Modified %s\n", path)
            }
        return nil
    })
}