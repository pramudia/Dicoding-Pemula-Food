using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.SceneManagement;

public class menu : MonoBehaviour
{

	
  	public bool isEscapeToExit;
	GameObject creditPanel;

    // Use this for initialization
    void Start()
    {
		creditPanel = GameObject.Find ("Panel");
		creditPanel.SetActive (false);
    }
    // Update is called once per frame
    void Update()
    {
        if (Input.GetKeyUp(KeyCode.Escape))
        {
            if (isEscapeToExit)
            {
                Application.Quit();
            }
            else
            {
                KembaliKeMenu();
            }
        }
    }
    public void MulaiPermainan()
    {
        SceneManager.LoadScene("main");
    }
    
	public void KembaliKeMenu()
    {
        SceneManager.LoadScene("menu");
    }

	public void Credit(){
		creditPanel.SetActive (true);
	}

	public void closeCredit(){
		creditPanel.SetActive (false);
	}

	public void ExitGame(){
		Application.Quit();
	}
}